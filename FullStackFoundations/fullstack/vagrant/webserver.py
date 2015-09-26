from BaseHTTPServer import BaseHTTPRequestHandler, HTTPServer
import cgi


from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker

from database_setup import Restaurant, Base, MenuItem

engine = create_engine('sqlite:///restaurantmenu.db')
# Bind the engine to the metadata of the Base class so that the
# declaratives can be accessed through a DBSession instance
Base.metadata.bind = engine

DBSession = sessionmaker(bind=engine)

session = DBSession()

class WebServerHandler(BaseHTTPRequestHandler):

    def do_GET(self):
        try:
            if self.path.endswith("/hello"):
                self.send_response(200)
                self.send_header('Content-type', 'text/html')
                self.end_headers()
                message = ""
                message += "<html><body>"
                message += "<h1>Hello!>/h1>"
                message += '''<form method='POST' enctype='multipart/form-data' action='/hello'><h2>What would you like me to say?</h2><input name="message" type="text" ><input type="submit" value="Submit"> </form>'''
                message += "</body></html>"
                self.wfile.write(message)
                print message
                return
            if self.path.endswith("/hola"):
                self.send_response(200)
                self.send_header('Content-type', 'text/html')
                self.end_headers()
                message = ""
                message += "<html><body>"
                message += "<h1>&#161 Hola !</h1>"
                message += '''<form method='POST' enctype='multipart/form-data' action='/hello'><h2>What would you like me to say?</h2><input name="message" type="text" ><input type="submit" value="Submit"> </form>'''
                message += "</body></html>"
                self.wfile.write(message)
                print message
                return
            if self.path.endswith("/restaurants"):
                self.send_response(200)
                self.send_header('Content-type', 'text/html')
                self.end_headers()
                message = ""
                message += "<html><body>"
                message += '<a href= "/restaurants/new">Make a new restaurant here</a>'
                restaurants = session.query(Restaurant).all()
                for restaurant in restaurants:
                    message += "<h1>" + restaurant.name + "</h1>"
                    message += '<a href= "/restaurants/%d/edit">Edit</a>'%restaurant.id + "<br>"
                    message += '<a href= "/restaurants/%d/delete">Delete</a>'%restaurant.id 
                
                message += "</body></html>"
                self.wfile.write(message)
                print message
                return

            if self.path.endswith("/restaurants/new"):
                self.send_response(200)
                self.send_header('Content-type', 'text/html')
                self.end_headers()
                message = ""
                message += "<html><body>"
                message += "<h1>Make a New Restaurant</h1>"
                message += "<form method = 'POST' enctype='multipart/form-data' action = '/restaurants/new'>"
                message += "<input name = 'newRestaurantName' type = 'text' placeholder = 'New Restaurant Name' > "
                message += "<input type='submit' value='Create'>"
                message += "</form></body></html>"
                message += "</body></html>"
                self.wfile.write(message)
                print message
                return

            if self.path.endswith("/delete"):
                self.send_response(200)
                self.send_header('Content-type', 'text/html')
                self.end_headers()
                id = int(self.path.split("/")[-2])
                restaurant = session.query(Restaurant).filter(Restaurant.id == id).one()
                if restaurant != []:
                    message = ""
                    message += "<html><body>"
                    message += "<h1>Are you sure you want to delete %s ?</h1>"%(restaurant.name)
                    message += "<form method = 'POST' enctype='multipart/form-data' action = '/restaurants/%d/delete'>"%id
                    message += "<input type='submit' value='Delete'>"
                    message += "</form></body></html>"
                    message += "</body></html>"
                    self.wfile.write(message)
                    print message
                return

            if self.path.endswith("/delete"):
                self.send_response(200)
                self.send_header('Content-type', 'text/html')
                self.end_headers()
                id = int(self.path.split("/")[-2])
                restaurant = session.query(Restaurant).filter(Restaurant.id == id).one()
                if restaurant != []:
                    message = ""
                    message += "<html><body>"
                    message += "<h1>%s</h1>"%(restaurant.name)
                    message += "<form method = 'POST' enctype='multipart/form-data' action = '/restaurants/%d/edit'>"%id
                    message += "<input name = 'newRestaurantName' type = 'text' placeholder = 'New Name' > "
                    message += "<input type='submit' value='Rename'>"
                    message += "</form></body></html>"
                    message += "</body></html>"
                    self.wfile.write(message)
                    print message
                return

        except IOError:
            self.send_error(404, 'File Not Found: %s' % self.path)

    def do_POST(self):
        try:
            if self.path.endswith("/restaurants/new"):
                ctype, pdict = cgi.parse_header(
                    self.headers.getheader('content-type'))
                if ctype == 'multipart/form-data':
                    fields = cgi.parse_multipart(self.rfile, pdict)
                    messagecontent = fields.get('newRestaurantName')

                    # Create new Restaurant Object
                    newRestaurant = Restaurant(name=messagecontent[0])
                    session.add(newRestaurant)
                    session.commit()

                    self.send_response(301)
                    self.send_header('Content-type', 'text/html')
                    self.send_header('Location', '/restaurants')
                    self.end_headers()

            if self.path.endswith("/edit"):
                ctype, pdict = cgi.parse_header(
                    self.headers.getheader('content-type'))
                if ctype == 'multipart/form-data':
                    fields = cgi.parse_multipart(self.rfile, pdict)
                    messagecontent = fields.get('newRestaurantName')
                    restaurantIDPath = int(self.path.split("/")[-2])

                    restaurant = session.query(Restaurant).filter_by(id = restaurantIDPath).one()
                    if restaurant != []:
                        restaurant.name = messagecontent[0]
                        session.add(restaurant)
                        session.commit()

                        self.send_response(301)
                        self.send_header('Content-type', 'text/html')
                        self.send_header('Location', '/restaurants')
                        self.end_headers()

            if self.path.endswith("/delete"):
    
    
                restaurantIDPath = int(self.path.split("/")[-2])

                restaurant = session.query(Restaurant).filter_by(id = restaurantIDPath).one()
                if restaurant:
                    session.delete(restaurant)
                    session.commit()
                    self.send_response(301)
                    self.send_header('Content-type', 'text/html')
                    self.send_header('Location', '/restaurants')
                    self.end_headers()
            # self.send_response(301)
            # self.send_header('Content-type', 'text/html')
            # self.end_headers()
            # ctype, pdict = cgi.parse_header(
            #     self.headers.getheader('content-type'))
            # if ctype == 'multipart/form-data':
            #     fields = cgi.parse_multipart(self.rfile, pdict)
            #     messagecontent = fields.get('message')
            # output = ""
            # output += "<html><body>"
            # output += " <h2> Okay, how about this: </h2>"
            # output += "<h1> %s </h1>" % messagecontent[0]
            # output += '''<form method='POST' enctype='multipart/form-data' action='/hello'><h2>What would you like me to say?</h2><input name="message" type="text" ><input type="submit" value="Submit"> </form>'''
            # output += "</body></html>"
            # self.wfile.write(output)
            # print output
        except:
            pass


def main():
    try:
        port = 8080
        server = HTTPServer(('', port), WebServerHandler)
        print "Web Server running on port %s" % port
        server.serve_forever()
    except KeyboardInterrupt:
        print " ^C entered, stopping web server...."
        server.socket.close()

if __name__ == '__main__':
    main()