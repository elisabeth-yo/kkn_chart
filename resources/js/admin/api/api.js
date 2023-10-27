import axios from 'axios';
import useAuthStore from '../stores/auth';
import routeAdmin from '../router';

const BASE_URL = import.meta.env.VITE_APP_URL + 'api/';

const http = axios.create({
  baseURL: BASE_URL,
  withCredentials: true,
});

http.defaults.headers.common['Content-Type'] = 'application/json';

http.interceptors.response.use(
  (response) => {
    return response;
  },
  async (error) => {
    const authStore = useAuthStore();
    if (error.response.status === 401) {
      authStore.logoutUser();
      routeAdmin.push({ name: 'admin.login' });
    }
    return Promise.reject(error);
  }
);

export const requestGet = async (url, params, statusToken = true) => {
  const authStore = useAuthStore();
  if (statusToken) {
    http.defaults.headers.common['Authorization'] = `Bearer ${authStore.token}`;
  }
  http.defaults.params = params;
  const response = await http.get(url);
  return response.data;
};

export const requestPost = async (url, params, statusToken = true) => {
  const authStore = useAuthStore();
  if (statusToken) {
    http.defaults.headers.common['Authorization'] = `Bearer ${authStore.token}`;
  }
  http.defaults.params = null;
  const response = await http.post(url, params);
  return response.data;
};

export const requestPatch = async (url, paramQuery, params, statusToken = true) => {
  const authStore = useAuthStore();
  if (statusToken) {
    http.defaults.headers.common['Authorization'] = `Bearer ${authStore.token}`;
  }
  http.defaults.params = paramQuery;
  const response = await http.post(url, params);
  return response.data;
};

export const requestDelete = async (url, statusToken = true) => {
  const authStore = useAuthStore();
  if (statusToken) {
    http.defaults.headers.common['Authorization'] = `Bearer ${authStore.token}`;
  }
  http.defaults.params = null;
  const response = await http.delete(url);
  return response.data;
};