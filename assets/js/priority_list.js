import { PriorityLinesSockets } from '../agent/extras.js';
import { variables } from './variables.js';

const { apiKey, apiURI } = variables;

const priorityLinesSockets = new PriorityLinesSockets( { apiURI, apiKey });

priorityLinesSockets.registerToPriorityLineUpdate((priorityLists) => {
    console.log(priorityLists);
})