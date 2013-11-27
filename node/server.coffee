io = require('socket.io').listen(2222)
io.sockets.on 'connection', (socket) ->
    #socket.emit 'message', content: 'pippo pluto paperino'

    rabbitHub = require('rabbitmq-nodejs-client');

    subHub = rabbitHub.create( { task: 'sub', channel: 'rabbit-node-test' } );
    #subHub = rabbitHub.create( { task: 'sub' } );
    subHub.on 'connection', (hub) ->
        hub.on 'message', (msg) ->
            socket.emit 'message', date: new Date(), content: msg

    subHub.connect()

    socket.on 'disconnect', ->
        io.sockets.emit('user disconnected')
        subHub.end()