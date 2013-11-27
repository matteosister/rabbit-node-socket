socket = io.connect('http://localhost:2222')
socket.on 'message', (msg) ->
    container = $('div.messages')
    div = $ '<div>'
    div.html msg.date + " - " + msg.content
    container.prepend div