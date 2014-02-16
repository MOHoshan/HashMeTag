// jQuery script for search request with server
jQuery(document).ready(function($) {

	// Run when Search button is clicked
	$('#search_button').click(function(){
		
		// Display a progress indicator
		$('#search_results').html('<img src="ajax_loader.gif"> Searching Twitter...');
		
		// Get the value of the input field
		
		var search_value = encodeURIComponent($('input[name=search_terms]').val());
		
		// Send the search terms to the server in an Ajax request
	
		$.ajax({
			url: 'http://localhost:8080/FeedMeHash/search_server.php?q=' + search_value,
			success: function(data){
				
				// Display the results
				$('#search_results').html(data);
			}
		})
	})
});