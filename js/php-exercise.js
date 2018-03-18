/**
 * php-exercise to connect apiUrl and query as properties from instantiation
 * Initializing the AJAX request data and calling the AJAX function
 * @author Senthilkumar Gunasekaran <gskumarmail@gmail.com>
 */

/**
 * Requesting page data as AJAX and rendering log data lines into Table
 * @method getDate
 * @param {JSON} requestData - AJAX request data
 * @return {void} It wont return any value. DOM changes
 */
getDate = () => {
    let requestData = {};
    let responseData = '';
    requestData = {
        day: $('#day').val(),
        month: $('#month').val(),
        year: $('#year').val()
    };
    this.getAjaxLoader();
    $.post('api.php', requestData,
        function(response) {
            if (response.status == 'success') {
                responseData = response.data;
            } else if (response.status == 'error' && response.data != 400) {
                responseData = '<span style="color:red">' + response.message + '</span>';
            } else {
                responseData = '<span style="color:red">' + response.message + '</span>';
            }
            $('#nextDate').html(responseData);
        },
        'json');
}
/**
 * [getAjaxLoader() - If response is delay ,load the progress bar based on the response from AJAX request]
 * @return {void} It wont return any value. DOM changes
*/
getAjaxLoader = () => {
    $('#nextDate').html('<div><img src="../images/ajax-loader.gif" /></div>');
}