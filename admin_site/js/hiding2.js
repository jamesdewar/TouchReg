
/* 
This script is jquery, it used to change the appearance of the main page.
using the jquery .click() method we choose to either  .show() or .hide() html elements
We use these methods for the display of the individual stats. 
As you can see it is a very repetitive script but necessary.
It is long because of the amounts of students registered in the database.



*/


$(document).ready(function(){

//we need to refresh to page to get all the stats. This code is adapted from this url: http://stackoverflow.com/questions/6985507/one-time-page-refresh-after-first-page-load

window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#reload';
        window.location.reload();
    }
}


		$("#list_course1").click(function(){
			$("#tableGraph").show();
			$("#individual_courses1").hide();
			$("#individual_courses2").hide();
			$("#individual_courses3").hide();
			$("#individual_courses4").hide();
			$("#individual_courses5").hide();
			$("#individual_courses6").hide();
			$("#individual_courses7").hide();
			$("#individual_courses8").hide();
			$("#individual_courses9").hide();
			$("#individual_courses10").hide();
			$("#individual_courses11").hide();
			$("#individual_courses12").hide();
			$("#individual_courses13").hide();
			$("#individual_courses14").hide();
			$("#individual_courses15").hide();
			$("#individual_courses16").hide();
			$("#individual_courses17").hide();
			$("#individual_courses18").hide();
			$("#individual_courses19").hide();
			$("#individual_courses20").hide();


		});

		$("#1").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").show();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();


		});


		$("#2").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").show();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();


		});


		$("#3").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").show();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();


		});


		$("#4").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").show();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();


		});


		$("#5").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").show();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();


		});

		$("#6").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").show();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();


				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});


		$("#7").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").show();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});

		$("#8").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").show();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();


		});

		$("#9").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").show();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});



		$("#10").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").show();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});


		$("#11").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").show();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});



		$("#12").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").show();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});



		$("#13").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").show();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});



		$("#14").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").show();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});


		$("#15").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").show();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});



		$("#16").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").show();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});



		$("#17").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").show();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});



		$("#18").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").show();
				$("#individual_courses19").hide();
				$("#individual_courses20").hide();

		});



		$("#19").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").show();
				$("#individual_courses20").hide();

		});



		$("#20").click(function(){
				$("#tableGraph").hide();
				$("#individual_courses1").hide();
				$("#individual_courses2").hide();
				$("#individual_courses3").hide();
				$("#individual_courses4").hide();
				$("#individual_courses5").hide();
				$("#individual_courses6").hide();
				$("#individual_courses7").hide();
				$("#individual_courses8").hide();
				$("#individual_courses9").hide();
				$("#individual_courses10").hide();
				$("#individual_courses11").hide();
				$("#individual_courses12").hide();
				$("#individual_courses13").hide();
				$("#individual_courses14").hide();
				$("#individual_courses15").hide();
				$("#individual_courses16").hide();
				$("#individual_courses17").hide();
				$("#individual_courses18").hide();
				$("#individual_courses19").hide();
				$("#individual_courses20").show();
		});

});
