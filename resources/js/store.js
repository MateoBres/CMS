import Vue from 'vue'
import Vuex, { Store } from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
    strict: true,
    state() {
        return {
            token: localStorage.getItem("token") ? localStorage.getItem("token") : null,
            user: localStorage.getItem("user-data") ? localStorage.getItem("user-data") : null,
            retailer: localStorage.getItem('retailer') ? localStorage.getItem('retailer') : null,
            userId: localStorage.getItem('user-id') ? localStorage.getItem('user-id') : null,
            userRoleName: localStorage.getItem('user-role-name') ? localStorage.getItem('user-role-name') : null,
            isRetailer: localStorage.getItem('user-is-retailer') ? localStorage.getItem('user-is-retailer') : null,
            retailerId: localStorage.getItem('retailer-id') ? localStorage.getItem('retailer-id') : null,
            retailerAddressId: localStorage.getItem('retailer-address-id') ? localStorage.getItem('retailer-address-id') : null,
            retailerVat: localStorage.getItem('retailer-vat') ? localStorage.getItem('retailer-vat') : null,
            retailerSlug: localStorage.getItem('retailer-slug') ? localStorage.getItem('retailer-slug') : null,
            isLoggedIn: !!localStorage.getItem("token"),
            userName: localStorage.getItem('user-name') ? localStorage.getItem('user-name') : null,
            

            order: localStorage.getItem('order') ? JSON.parse(localStorage.getItem('order')) : null,
            items: localStorage.getItem('items') ? JSON.parse(localStorage.getItem('items')) : null,
        }
    },
    mutations: {
        setToken(state, token) {
            if (token) {
                state.token = token
                localStorage.setItem('token', token)
                state.isLoggedIn = true
            } else {
                //localStorage.setItem("token", null);
                //localStorage.setItem("isUserLoggedIn", false);
                state.token = null;
                state.isLoggedIn = false
            }
        },
        setUser(state, user) {
            state.user = user
        },
        setIsLoggedIn(state) {
            state.isLoggedIn = !!state.token
        },
        setUserId(state, userId) {
            state.userId = userId
            localStorage.setItem('user-id', userid)
        },
        setUserRoleName(state, userRoleName) {
            state.userRoleName = userRoleName
            localStorage.setItem('user-role-name', userRoleName)
        },
        setRetailer(state, retailer) {
            state.retailer = retailer
        },
        setRetailerId(state, retailer_id) {
            state.retailerId = retailer_id
        },
        setRetailerAddressId(state, retailerAddressId) {
            state.retailerAddressId = retailerAddressId
        },
        setRetailerVat(state, retailerVat) {
            state.retailerVat = retailerVat
            localStorage.setItem('retailer-vat', retailerVat)
        },
        setRetailerSlug(state, retailerSlug) {
            state.retailerSlug = retailerSlug
            localStorage.setItem('retailer-slug', retailerSlug)
        },
        setUserName(state, userName) {
            state.userName = userName
            localStorage.setItem('user-name', userName)
        },
        login(state, data) {
            state.token = data.token
            localStorage.setItem('token', data.token)
            state.isLoggedIn = !!data.token
            state.userId = data.user.id
            localStorage.setItem('user-id', data.user.id)
            state.userName = data.user.name
            localStorage.setItem('user-name', data.user.name)
            state.userRoleName = data.user.roles[0].name
            localStorage.setItem('user-role-name', data.user.roles[0].name)
            state.user = JSON.stringify(data.user)
            localStorage.setItem('user-data', JSON.stringify(data.user))
            state.isRetailer = data.user.isRetailer
            localStorage.setItem('user-is-retailer', data.user.isRetailer)

            if (data.user.retailers && data.user.retailers[0]) {
                let retailer = data.user.retailers[0]
                state.retailerId = retailer.id
                localStorage.setItem('retailer-id', retailer.id)
                state.retailerVat = retailer.vat
                localStorage.setItem('retailer-vat', retailer.vat)
                state.retailerSlug = retailer.slug
                localStorage.setItem('retailer-slug', retailer.slug)
                state.retailerAddressId = retailer.address ? retailer.address.id : null
                localStorage.setItem('retailer-address-id', state.retailerAddressId)
            }
        },
        updateUser(state, user) {
            state.user = JSON.stringify(user)
            localStorage.setItem('user-data', JSON.stringify(user))
        },
        logout(state) {
            state.token = null
            localStorage.removeItem('token')
            state.isLoggedIn = false
            state.userId = null
            localStorage.removeItem('user-id')
            state.userName = null
            localStorage.removeItem('user-name')
            state.userRoleName = null
            localStorage.removeItem('user-role-name')
            state.user = null
            localStorage.removeItem('user-data')
            state.isRetailer = null
            localStorage.removeItem('user-is-retailer')
            state.retailerId = null
            localStorage.removeItem('retailer-id')
            state.retailerVat = null
            localStorage.removeItem('retailer-vat')
            state.retailerAddressId = null
            localStorage.removeItem('retailer-address-id')
        },
        setRegistrationData(state, data) {
            state.token = data.token
            localStorage.setItem('token', state.token)
            state.isLoggedIn = true,
            state.userId = data.user.id,
            localStorage.setItem('user-id', state.userid)
            state.userName = data.user.name
            localStorage.setItem('user-name', data.user.name)
            state.userRoleName = data.user.roles[0].name
            localStorage.setItem('user-role-name', data.user.roles[0].name)
            state.user = JSON.stringify(data.user)
            localStorage.setItem('user-data', JSON.stringify(data.user))
            let retailer = data.retailer
            state.retailerId = retailer.id
            localStorage.setItem('retailer-id', retailer.id)
            state.retailerVat = retailer.vat
            localStorage.setItem('retailer-vat', retailer.vat)
            state.retailerSlug = retailer.slug
            localStorage.setItem('retailer-slug', retailer.slug)
            state.retailerAddressId = retailer.address ? retailer.address.id : null
            localStorage.setItem('retailer-address-id', state.retailerAddressId)
        },
        order(state, order) {
            state.order = order
            localStorage.setItem('order', JSON.stringify(order))
        },
        items(state, items) {
            state.items = items
            localStorage.setItem('items', JSON.stringify(items))
        },

        // cart
        addItem(state, { product, quantity, price, variation }) {
            if (state.items.length != 0) {
                let duplicates = state.items.filter(item => {
                    return item.item.id == product.id;
                });

                if (duplicates[0]) {
                    duplicates[0].qty += quantity;
                } else {
                    let new_item = {
                        item: product,
                        qty: quantity,
                        price: price,
                        variation: variation,
                        is_modified: false
                    }
                    state.items.push(new_item);
                }
            } else {
                let new_item = {
                    item: product,
                    qty: quantity,
                    price: price,
                    variation: variation,
                    is_modified: false
                }
                state.items.push(new_item)
            }
        },
        qtyPlus(state, product) {
            state.items.forEach(item => {
                if (item.item.id == product.item.id) {
                    item.qty++
                }
            })
        },
        qtyMinus(state, product) {
            state.items.forEach((item, index) => {
                if (item.item.id == product.item.id) {
                    if (item.qty > 0) {
                        item.qty--
                            if (item.qty == 0) {
                                state.items.splice(index, 1)
                            }
                    }
                }
            })
        },
        removeProduct(state, product) {
            state.items.forEach((item, index) => {
                if (item.item.id == product.item.id) {
                    state.items.splice(index, 1)
                }
            })
        },
        resetState(state) {
            state.items = []
            state.order = null
        },
        setOrder(state, order) {
            state.order = order
        },
        saveChanges(state) {
            localStorage.setItem('order', JSON.stringify(state.order))
            localStorage.setItem('items', JSON.stringify(state.items))
        }
    },
    actions: {
        login(context, payload) {
            context.commit('login', payload)
        },
        updateUser(context, payload) {
            context.commit('updateUser', payload)
        },
        logout({ commit }) {
            commit('logout')
        },
        setRegistrationData({ commit }, payload) {
            console.log('setRegistrationData-store')
            commit('setRegistrationData', payload)
        },
        setToken({ commit }, token) {
            commit('setToken', token)
        },
        setUser({ commit }, user) {
            commit('setUser', user)
        },
        addItem(context, payload) {
            context.commit('addItem', payload)
            context.dispatch('saveChanges')
        },
        qtyPlus(context, product) {
            context.commit('qtyPlus', product)
            context.dispatch('saveChanges')
        },
        qtyMinus(context, product) {
            context.commit('qtyMinus', product)
            context.dispatch('saveChanges')
        },
        removeProduct(context, product) {
            context.commit('removeProduct', product)
            context.dispatch('saveChanges')
        },
        setRetailer(context, retailer) {
            context.commit('setRetailer', retailer)
        },
        setRetailerId(context, retailer_id) {
            context.commit('setRetailerId', retailer_id)
        },
        setRetailerVat(context, retailerVat) {
            context.commit('setRetailerVat', retailerVat)
        },
        setRetailerSlug(context, retailerSlug) {
            context.commit('setRetailerSlug', retailerSlug)
        },
        resetState(context) {
            context.commit('resetState')
            context.dispatch('saveChanges')
        },
        setOrder(context, order) {
            context.commit('setOrder', order)
            context.dispatch('saveChanges')
        },
        saveChanges(context) {
            context.commit('saveChanges')
        }
    },
    getters: {
        isLoggedIn: state => !!state.token,
        token: state => state.token,
        user: state => state.user,
        isRetailer: state => state.isRetailer,
        userId: state => state.userId,
        userRoleName: state => state.userRoleName,
        retailerId: state => state.retailerId,
        retailerAddressId: state => state.retailerAddressId,
        retailerVat: state => state.retailerVat,
        userName: state => state.userName,
        order: state => state.order,
        items: state => state.items,
        itemsCount: state => {
            if (state.items && state.items.length > 0) {
                let count = 0
                state.items.forEach(item => {
                    count += item.qty
                });
                return count
            }
        }
    }
})
