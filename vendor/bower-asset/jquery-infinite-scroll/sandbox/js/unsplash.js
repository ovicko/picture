var container = document.querySelector('.container');

var unsplashID = '9ad80b14098bcead9c7de952435e937cc3723ae61084ba8e729adb642daf0251';

var infScroll = new InfiniteScroll( '.container', {
  path: 'https://api.unsplash.com/photos?page={{#}}&client_id=' + unsplashID,
  responseType: '',
  history: false,
});

infScroll.on( 'load', function( response ) {
  var data = JSON.parse( response );
  var itemsHTML = data.map( getItem ).join('');
  container.innerHTML += itemsHTML;
});

var itemTemplateSrc = document.querySelector('#item-template').innerHTML;

function getItem( photo ) {
  return microTemplate( itemTemplateSrc, photo );
}

// micro templating, sort-of
function microTemplate( src, data ) {
  // replace {{tags}} in source
  return src.replace( /\{\{([\w\-_\.]+)\}\}/gi, function( match, key ) {
    // walk through objects to get value
    var value = data;
    key.split('.').forEach( function( part ) {
      value = value[ part ];
    });
    return value;
  });
}

// load first page
infScroll.loadNextPage();
