export default {
 post(url, data) {
  const response = axios.post(url, data);
  return response;
 },

 get(url) {
  const response = axios.get(url);
  return response;
 },

 put(url, data) {
  const response = axios.put(url, data);
  return response;
 },

 delete(url) {
  const response = axios.delete(url);
  return response;
 },
};
