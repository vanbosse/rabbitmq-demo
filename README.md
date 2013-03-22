# Setup

Clone the repository and setup a vhost to your folder.

	git clone git://github.com/vanbosse/rabbitmq-demo.git

Initialize and update the submodule.

	git submodule init && git submodule update

Install node.js, get a copy at http://nodejs.org and install Socket.io and Rabbit.js

	npm install socket.io && npm install rabbit.js

Run server.js with node.

	node js/server.js

Run the update script which sends out an update every 3 seconds.

	php update.php

Visit your vhost and see the updates coming in.
