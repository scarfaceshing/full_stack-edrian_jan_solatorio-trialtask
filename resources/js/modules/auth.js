import router from '../router';

export default {
 namespaced: true,
 state: {
  user: [],
  isAuth: false,
  token: '',
 },
 mutations: {
  SET_USER(state, data) {
   state.user = data;
  },
  SET_AUTHENTICATED(state, data) {
   state.isAuth = data;
  },
  SET_TOKEN(state, data) {
   state.token = data;
  },
 },
 actions: {
  storeSession({ commit }, data) {
   const { user, token, isAuth } = data;
   commit('SET_USER', user);
   commit('SET_TOKEN', token);
   commit('SET_AUTHENTICATED', isAuth);
   router.push({ name: 'welcome' });
  },
  removeSession({ commit }) {
   commit('SET_USER', null);
   commit('SET_TOKEN', null);
   commit('SET_AUTHENTICATED', false);
   router.push({ name: 'login' });
  },
 },
 getters: {
  getUser(state) {
   return state.user;
  },
  getToken(state) {
   return state.token;
  },
  getAuth(state) {
   return state.isAuth;
  },
 },
};
