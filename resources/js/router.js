import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import index from './views/index';
import transactionComponent from './views/transactionComponent';
import historyController from './views/historyController';
import oneHistoryController from './views/oneHistoryController';
import settingsController from './views/settingsController';
import updateTransactionComponent from './views/updateTransactionComponent';

const routes=[
	{ 
		path: '/', 
		component: index 
	},
	{ 
		path: '/transaction', 
		component: transactionComponent 
	},
	{ 
		path: '/history', 
		component: historyController 
	},
	{ 
		path: '/history/:id', 
		component: oneHistoryController 
	},
	{ 
		path: '/history/:id/update', 
		component: updateTransactionComponent 
	},
	{ 
		path: '/settings', 
		component: settingsController 
	},
];

export default new vueRouter ({
	mode:"history",
	routes: routes
})