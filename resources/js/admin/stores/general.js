import { defineStore } from 'pinia';

const useGeneralStore = defineStore('general', {
    state: () => ({ 
        API_URL: import.meta.env.VITE_APP_URL + 'api/'
    }),
    getters: {
        getApiUrl: state => state.API_URL,
    }
});

export default useGeneralStore;