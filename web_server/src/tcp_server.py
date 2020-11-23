import socket
import threading

class TCPServer:
    def __init__(self, host='127.0.0.1', port=8080):
        self.host = host
        self.port = port

    def on_new_client(self, conn, addr):
        print("Connected by", addr)
        data = conn.recv(1024)

        response = self.handle_request(data)

        conn.sendall(response)
        conn.close()

    def start(self):
        s = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        s.setsockopt(socket.SOL_SOCKET, socket.SO_REUSEADDR, 1)
        s.bind((self.host, self.port))
        s.listen(5)

        print("Listening at", s.getsockname())

        while True:
            conn, addr = s.accept()
            x = threading.Thread(target=self.on_new_client, args=(conn, addr))
            x.start()

    def handle_request(self, data):
        """Handles incoming data and returns a response.
        Override this in subclass.
        """
        return data
