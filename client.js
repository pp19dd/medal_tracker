// modified from tabletop contribution libraries
// 2014-02-03 ebeslagic@voanews.com

// Function to cache spreadsheet to s3 with table-service server
// Call on-demand or however you like
function cacheChanges() {
	var key = SpreadsheetApp.getActiveSpreadsheet().getId();

	var payload = {
		"key" : key
	};

	var options = {
		"method" : "post",
		"payload" : payload
	};

	UrlFetchApp.fetch("http://tools.voanews.com/data/ping.php?project=medal_tracker", options);
}

// This cache may save a "short" version of your spreadsheet's key
// You can check it with a menu option

function onOpen() {
	var ss = SpreadsheetApp.getActiveSpreadsheet();
	var menuEntries = [
		//{name: "Get key...", functionName: "getCode"},
		{name: "Synchronize to akamai", functionName: "cacheChanges"}
	];
	ss.addMenu("VOA News", menuEntries);
}

function getCode() {
	var key = SpreadsheetApp.getActiveSpreadsheet().getId();
	var msg = key;

	Browser.msgBox(msg);
}