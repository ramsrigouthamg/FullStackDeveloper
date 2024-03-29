from flask import Flask , render_template,request, redirect,url_for, flash, jsonify
app = Flask(__name__)

from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker
from database_setup import Base, Restaurant, MenuItem

engine = create_engine('sqlite:///restaurantmenu.db')
Base.metadata.bind = engine

DBSession = sessionmaker(bind=engine)
session = DBSession()
#Fake Restaurants
#restaurant = {'name': 'The CRUDdy Crab', 'id': '1'}

#restaurants = [{'name': 'The CRUDdy Crab', 'id': '1'}, {'name':'Blue Burgers', 'id':'2'},{'name':'Taco Hut', 'id':'3'}]


#Fake Menu Items
#items=[]
#items = [ {'name':'Cheese Pizza', 'description':'made with fresh cheese', 'price':'$5.99','course' :'Entree', 'id':'1'}, {'name':'Chocolate Cake','description':'made with Dutch Chocolate', 'price':'$3.99', 'course':'Dessert','id':'2'},{'name':'Caesar Salad', 'description':'with fresh organic vegetables','price':'$5.99', 'course':'Entree','id':'3'},{'name':'Iced Tea', 'description':'with lemon','price':'$.99', 'course':'Beverage','id':'4'},{'name':'Spinach Dip', 'description':'creamy dip with fresh spinach','price':'$1.99', 'course':'Appetizer','id':'5'} ]
#item =  {'name':'Cheese Pizza','description':'made with fresh cheese','price':'$5.99','course' :'Entree'}



# Adding JSON API Functionality here
@app.route('/restaurants/JSON/')
def restaurantsJSON():
	restaurants = session.query(Restaurant).all()
	return jsonify(Restaurants=[i.serialize for i in restaurants])

@app.route('/restaurants/<int:restaurant_id>/menu/JSON/')
def restaurantMenuJSON(restaurant_id):
	restaurant = session.query(Restaurant).filter_by(id=restaurant_id).one()
	items = session.query(MenuItem).filter_by(
		restaurant_id=restaurant_id).all()
	return jsonify(MenuItems=[i.serialize for i in items])

@app.route('/restaurants/<int:restaurant_id>/menu/<int:menu_id>/JSON/')
def menuItemJSON(restaurant_id, menu_id):
	menuItem = session.query(MenuItem).filter_by(id=menu_id).one()
	return jsonify(MenuItem=menuItem.serialize)



 #Actual Functionality   

@app.route('/')
@app.route('/restaurants/')
def showRestaurants():
	#return "Thsi page will show all of my restaurants"
	restaurants = session.query(Restaurant).all()
	return render_template('restaurants.html',restaurants=restaurants)
 

@app.route('/restaurant/new/',methods=['GET', 'POST'])
def newRestaurant():
	if request.method == 'POST':
		newRestaurant=Restaurant(name=request.form['name'])
		session.add(newRestaurant)
		session.commit()
		flash("Restaurant has been added!")
		return redirect(url_for('showRestaurants'))
	else:
		return render_template('newRestaurant.html')
	

@app.route('/restaurant/<int:restaurant_id>/edit/',methods=['GET', 'POST'])
def editRestaurant(restaurant_id):
	editedItem = session.query(Restaurant).filter_by(id=restaurant_id).one()
	if request.method == 'POST':
		if request.form['name']:
			editedItem.name = request.form['name']
		session.add(editedItem)
		session.commit()
		flash("Restaurant has been edited!")
		return redirect(url_for('showRestaurants'))
	else:
		# USE THE RENDER_TEMPLATE FUNCTION BELOW TO SEE THE VARIABLES YOU
		# SHOULD USE IN YOUR EDITMENUITEM TEMPLATE
		return render_template('editRestaurant.html',restaurant=editedItem)


@app.route('/restaurant/<int:restaurant_id>/delete/',methods=['GET', 'POST'])
def deleteRestaurant(restaurant_id):
	restaurant = session.query(Restaurant).filter_by(id=restaurant_id).one()
	if request.method == 'POST':
		session.delete(restaurant)
		session.commit()
		flash("Restaurant has been deleted!")
		return redirect(url_for('showRestaurants'))
	else:
		return render_template('deleteRestaurant.html',restaurant=restaurant)

@app.route('/restaurant/<int:restaurant_id>/')
@app.route('/restaurant/<int:restaurant_id>/menu/')
def menu(restaurant_id):
	restaurant = session.query(Restaurant).filter_by(id=restaurant_id).one()
	items = session.query(MenuItem).filter_by(restaurant_id=restaurant.id)
	return render_template('menu.html',restaurant=restaurant,items=items)

@app.route('/restaurant/<int:restaurant_id>/menu/new/',methods=['GET', 'POST'])
def newMenuitem(restaurant_id):
	if request.method == 'POST':
		newItem = MenuItem(
			name=request.form['name'], restaurant_id=restaurant_id,description = request.form['description'], price=request.form['price'],course=request.form['course'])
		session.add(newItem)
		session.commit()
		flash("New menu item created!")
		return redirect(url_for('menu', restaurant_id=restaurant_id))
	else:
		return render_template('newMenuitem.html', restaurant_id=restaurant_id)
	

@app.route('/restaurant/<int:restaurant_id>/menu/<int:menu_id>/edit/',methods=['GET', 'POST'])
def editMenuitem(restaurant_id,menu_id):
	editedItem = session.query(MenuItem).filter_by(id=menu_id).one()
	restaurant = session.query(Restaurant).filter_by(id=restaurant_id).one()
	if request.method == 'POST':
		if request.form['name']:
			editedItem.name = request.form['name']
		session.add(editedItem)
		session.commit()
		flash("Menu item has been edited!")
		return redirect(url_for('menu', restaurant_id=restaurant_id))
	else:
		# USE THE RENDER_TEMPLATE FUNCTION BELOW TO SEE THE VARIABLES YOU
		# SHOULD USE IN YOUR EDITMENUITEM TEMPLATE
		return render_template(
			'editMenuitem.html', restaurant=restaurant,item=editedItem)
	

@app.route('/restaurant/<int:restaurant_id>/menu/<int:menu_id>/delete/',methods=['GET', 'POST'])
def deleteMenuitem(restaurant_id,menu_id):
	item = session.query(MenuItem).filter_by(id=menu_id).one()
	if request.method == 'POST':
		session.delete(item)
		session.commit()
		flash("MenuItem has been deleted!")
		return redirect(url_for('menu',restaurant_id=restaurant_id))
	else:
		return render_template('deleteMenuitem.html',restaurant=restaurant,item=item)

if __name__ == '__main__':
	app.secret_key = 'super_secret_key'
	app.debug = True
	app.run(host='0.0.0.0', port=5000)