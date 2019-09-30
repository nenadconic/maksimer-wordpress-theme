/* eslint-env jquery */

/**
 * Document ready
 */
jQuery( () => { } );

const first = 'Kim';

const name = `Your name is ${ first }.`;

const fourAgreements = `You have the right to be you.
You can only be you when you do your best.`;

const evens = [ 1, 2, 3, 4, 5 ];

const spread = [ ...evens ];

const odds = evens.map( ( n ) => n + 1 );

$( '.btn' ).click( ( event ) => {
	this.sendData();
} );

const wait1000 = new Promise( ( resolve, reject ) => {
	setTimeout( resolve, 1000 );
} ).then( () => {
	console.log( 'Yay!' );
} );
