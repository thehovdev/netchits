const searchYT = require('youtube-api-v3-search');

const token = 'YOUR TOKEN';


Youtube = {
     search(q) {
	 const options = {
	     part: 'snippet',
	     q: q,
	     type: 'video',
	     maxResults: 9
	 };
	 
	 let result = searchYT(token, options);

	 return result;
     }
}
