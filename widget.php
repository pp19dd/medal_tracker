
<!--  

for launch, move these to absolute URLs behind akamai 

 -->
<script src="jquery.min.js" type="text/javascript"></script>
<script src="raphael-min.js" type="text/javascript"></script>
<script src="tabletop.mod.cache.js" type="text/javascript"></script>

<!--  remove this style section before launch  -->
<style>
body { background-color: gray; margin:2em }
</style>

<!--  remove this table debug section before launch  -->

<table>
	<tr>
		<td style="width:50%"><img src="Top-10-Medalists2.png" /></td>
		<td style="width:50%"><div id="medal_tracker">Loading...</div></td>
	</tr>
</table>


<script type="text/javascript">
var paper;
var rows = [];
function medal_count( v_options ) {

	$("#medal_tracker").css( {
		width:308,
		height:530
	}).html( "" );

	var style = {
		title: { 'font-family': 'Arial', 'font-size': 16, 'font-weight': 'bold', 'fill': 'white' },
		credits: { 'font-family': 'Verdana', 'font-size': 10, 'font-weight': 'normal', 'fill': 'black', 'cursor': 'pointer' },
		credits_hover: { 'fill': 'darkblue' },
		country: { 'font-family': 'Arial', 'font-size': 11, 'font-weight': 'bold', 'fill': 'gray', 'text-anchor': 'start' },
		medal: { 'font-family': 'Arial', 'font-size': 20, 'font-weight': 'bold', 'fill': 'black', 'text-anchor': 'end' },
		liner: { 'fill': 'orange', opacity:0, 'stroke-width': 0 },
		liner2: { 'fill': 'red', opacity:0 }
	};

	function a_in(node_row) {
		node_row[0].stop().animate( {
			opacity: 0.4,
			transform: 'S1.0'
		}, 200, "<>" );
		//node_row[2].stop().animate( { fill: 'darkorange' }, 100, "<>" );
		//node_row[1]._g = node_row[1].glow( { 'color': 'white', 'width': 15 } );
	}

	function a_out(node_row) {
		node_row[0].stop().animate( {
			opacity: 0,
			transform: 'S0.7'
		}, 600, "<>" );
		//node_row[2].stop().animate( style.medal, 300, "<>" );
		//node_row[1]._g.remove();
	}

	function loaded(doc) {
		for( i = 0; i < 10; i++ ) (function(e, i) {
			y = 100 + (i * 39.5);
			y2 = y + 17;

			// happens i corresponds to rows.length-1
			rows.push( paper.set() );

			// animated 'cursor'
			rows[i].push( paper.rect( 20, y, 270, 30 ).attr( style.liner ) );
			
			rows[i].push( paper.image( e.flagurl, 30, y+3, 40, 24 ) );
			rows[i].push( paper.text( 75, y + 20, e.countrysymbol ).attr( style.country ) );

			rows[i].push( paper.text( 165, y2, e.gold ).attr( style.medal ) );
			rows[i].push( paper.text( 218, y2, e.silver ).attr( style.medal ) );
			rows[i].push( paper.text( 267, y2, e.bronze ).attr( style.medal ) );

			// event trigger
			rows[i].push( paper.rect( 0, y-2, 308, 39 ).attr( style.liner2 ) );

			rows[i][6].mouseover( function() { a_in(rows[i] ); } );
			rows[i][6].mouseout( function() { a_out(rows[i] ); } );

		})(doc[i], i);
	}
	
	Raphael( function() {
		
		$("#paper_medals").html("");

		paper = Raphael("medal_tracker", 308, 530 );
		paper.image( "medal-tracker-2014a.png", 0, 0, 308, 530 );
		paper.text( 154, 17, v_options.title ).attr( style.title );
		paper.text(
			154, 503, v_options.credits + " http://www.olympic.org/"
		).attr(
			style.credits
		).mouseover(function() {
			this.attr( style.credits_hover );
		}).mouseout(function() {
			this.attr( style.credits );
		}).click(function() {
			window.open( "http://www.olympic.org/", "_blank" );
		});
		
		Tabletop.init({
			proxy: "http://tools.voanews.com/data/medal_tracker",			
			key: '0ApMStbHjfYCfdHN5dUJiQXcwVWtOcThYMkdodWYteEE',
			url_suffix: "?rand=" + Math.random(), 
			callback: function(doc) {
				loaded(doc);
			},
			simpleSheet: true
		});
	});
}

</script>

<script type="text/javascript">
medal_count( {
	title: 'TOP 10 MEDAL COUNT',
	credits: 'See complete list at'
});
</script>
