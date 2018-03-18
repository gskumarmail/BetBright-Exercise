/**
 * js-exercise to fetch images from Flicker API
 * JSONP has been used for cross origin issues from Flicker API
 * @author Senthilkumar Gunasekaran <gskumarmail@gmail.com>
 */
let tagName;
/* constant value for images limit */
const images_limit = 5;
/**
 * [loadImages() - dynamically creating and rendering the DOM image list based on API result set]
 * JSONP has been used for cross origin issues
 * attaching random number along with the JSONP callback name for security
 * registered client_id is used to be compatible with Twitch API conventions
 * @param  {[object]} obj [obj that will be passing by clicking tabs]
 * @return {void} It wont return any value. DOM changes
 */
loadImages = (obj) => {
    tagName = obj.value;
    this.getAjaxLoader();
    const url = "https://api.flickr.com/services/feeds/photos_public.gne?tags=" + tagName + "&format=json";
    const id = '_' + Math.round(10000 * Math.random())
    const callbackName = 'jsonp_callback_' + id
    const script = document.createElement('script');
    script.type = 'text/javascript';
    script.async = true;
    script.src = url + (url.indexOf('?') === -1 ? '?' : '&') + 'callback=' + callbackName;
    document.getElementsByTagName('head')[0].appendChild(script);
}
/**
 * [jsonFlickrFeed() - render the new image result set from JSONP server call]
 * @param  {[object]} json [json that will be returned from JSONP API server call]
 * dynamically creating and rendering the DOM images list based on API result set
 * @return {void} It wont return any value. DOM changes
*/
jsonFlickrFeed = (json) => {
    const images = json.items;
    document.getElementById(tagName).innerHTML = '';
    const modal = document.getElementById('light-box');
    const modalImg = document.getElementById("light-box-image");
    const captionText = document.getElementById("lightbox-image-caption");
    const span = document.getElementsByClassName("lightbox-close")[0];
    images.forEach(function(val, index) {
        if (index < images_limit) {
            const img = document.createElement('img');
            img.src = val.media.m;
            img.setAttribute("class", "image-content");
            img.alt = val.title;
            document.getElementById(tagName).appendChild(img);
            img.onclick = function() {
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }
            span.onclick = function() {
                modal.style.display = "none";
            }
        }
    })
}
/**
 * [getAjaxLoader() - If response is delay ,load the progress bar based on the response from JSONP server call]
 * @return {void} It wont return any value. DOM changes
*/
getAjaxLoader = () => {
    document.getElementById(tagName).innerHTML = '<div><img src="../images/ajax-loader.gif" /></div>';
}