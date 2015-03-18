
//Adapted as an implemitation of a blog post: http://stackoverflow.com/questions/13104744/onclick-on-div-load-content-from-database-on-other-div

$('.clickable').on('click', function(){
		var data_id = $(this).data('id');
		$.ajax({
url: 'ajax-2.php',
type: 'POST',
data: {id: data_id},
dataType: 'json',
success: function(data){
;
$('#personal').html(data.html);
},
error: function(jqXHR, textStatus, errorThrown){
//$('#more-info').html('');
alert('Error Loading');
}
});
		});

