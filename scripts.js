$(document).ready(function() {	 
	// request.fail(function( jqXHR, textStatus ) {
	// 	alert( "Request failed: " + textStatus );
	// });

	function dbConnect() {
		dbHost = $("#dbHost").val();
		dbLogin = $("#dbLogin").val();
		dbPass = $("#dbPass").val();
		dbBase = $("#dbBase").val();
		var result = [dbHost, dbLogin, dbPass, dbBase];
		return result;
	}

	$("#scanDir").click( function() {
		var dbConnecta = dbConnect();
		var catalog = $("#catalog").val();
 		var request = $.ajax({
			url: "ajax.php",
			method: "POST",
			data: { 
				code: "scanDir",
				catalog: catalog,
				dbHost: dbConnecta[0],
				dbLogin: dbConnecta[1],
				dbPass: dbConnecta[2],
				dbBase: dbConnecta[3],
			},
			dataType: "json"
		});
		request.done(function(response) {
			//$( "#log" ).html( response );
			//var data = jQuery.parseJSON(response);
			//console.log(response);
			// var data = [
			// 	{"label":"catalog","children":[{"label":"file00.tt"},{"label":"file01.txt"}]}
			// ];
			var data = [response];
			//var data[] = response;
		    $('#tree').tree({
		        data: data
		    });
		});
	});
	$("#dbConnect").click( function() {
		dbHost = $("#dbHost").val();
		dbLogin = $("#dbLogin").val();
		dbPass = $("#dbPass").val();
		dbBase = $("#dbBase").val();
 		var request = $.ajax({
			url: "ajax.php",
			method: "POST",
			data: { 
				code: "dbConnect",
				dbLogin: dbLogin,
				dbPass: dbPass,
				dbHost: dbHost,
				dbBase: dbBase,
			},
			dataType: "html"
		});
		request.done(function( msg ) {
			$( "#log" ).html( msg );
		});
	});
	$("#dbReading").click( function() {
		// dbBase = $("#dbBase").val();
 		var request = $.ajax({
			url: "ajax.php",
			method: "POST",
			data: { 
				code: "dbReading",
  				// dbBase: dbBase,
			},
			dataType: "html"
		});
		request.done(function( msg ) {
			$( "#log" ).html( msg );
		});
	});
	$("#countFiles").click(function(){
		catalog = 'D:/Programm/OpenServer5/OpenServer/domains/work/aspro/dz1/catalog/';
		var dbConnecta = dbConnect();
 		var request = $.ajax({
			url: "ajax.php",
			method: "POST",
			data: { 
				code: "countFiles",
  				catalog: catalog,
				dbHost: dbConnecta[0],
				dbLogin: dbConnecta[1],
				dbPass: dbConnecta[2],
				dbBase: dbConnecta[3],
			},
			dataType: "html"
		});
		request.done(function( msg ) {
			$( "#log" ).html( msg );
		});		
	});
	$("#dbReadToJson").click( function() {
		var dbConnecta = dbConnect();
 		var request = $.ajax({
			url: "ajax.php",
			method: "POST",
			data: { 
				code: "dbReadToJson",
				dbHost: dbConnecta[0],
				dbLogin: dbConnecta[1],
				dbPass: dbConnecta[2],
				dbBase: dbConnecta[3],
			},
			dataType: "json"
		});
		request.done(function(response) {
				var data = [
				    {
				        label: 'node1',
				        children: response
				    },
				    {
				        label: 'node2',
				        children: [
				            { label: 'child3' }
				        ]
				    }
				];
			    $('#tree').tree({
			        data: data
			    });
		});
	});


	var data = [
	    {
	        label: 'node1',
	        children: [
	            { label: 'child1' },
	            { label: 'child2' }
	        ]
	    },
	    {
	        label: 'node2',
	        children: [
	            { label: 'child3' }
	        ]
	    }
	];

    $('#tree1').tree({
        data: data
    });
})