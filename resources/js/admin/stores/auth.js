import { defineStore } from 'pinia';

const useAuthStore = defineStore('auth', {
    state: () => ({
        token: localStorage.getItem("token") || null,
        storedUser: localStorage.getItem('user') || null
    }),
    getters: {
        user: state => {
            if (!!state.storedUser) {
                return JSON.parse(state.storedUser);
            }
            return state.storedUser;
        },
        userIsAuth: state => state.token
    },
    actions: {
        storeLoggedInUser(token, user) {
            const _this = this;

            // Save the token to localStorage
            localStorage.setItem('token', token);

            // Save the user to localStorage
            const stringifiedUser = JSON.stringify (user);
            localStorage.setItem('user', stringifiedUser);

            // Save the token and user to the store ktate
            _this.token = token;
            _this.storedUser = stringifiedUser;
        },
        logoutUser() {
            const _this = this;
        
            // Delete the token from localStorage
            localStorage.removeItem('token');
        
            // Delete the user from localStorage
            localStorage.removeItem('user');
        
            // Delete the token and user from the state
            _this.token = null;
            _this.storedUser = null;
        }
    }
});

export default useAuthStore;