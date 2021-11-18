// import Home from '../pages/Home'
import Homepage from '../pages/Homepage'
// import HomepageDesktop from '../pages/HomepageDesktop'
// import HomepageMobile from '../pages/HomepageMobile'

import Login from '../pages/Login'
import LoginCustomer from '../pages/LoginCustomer'
// import Registrati from '../pages/Registrati'
import RegistraAzienda from '../pages/RegistraAzienda'
import Shop from '../pages/Shop'

import ProductPage from '../pages/Prodotto'
//import ProductPage_old from '../pages/Prodotto_old' // da rimuovere

import Publisher from '../pages/publisher/Publisher'
import InfoPublisher from '../pages/publisher/InfoPublisher'
import OrdersPublisher from '../pages/publisher/OrdersPublisher'
import ItemsPublisher from '../pages/publisher/ItemsPublisher'
import ItemPage from '../pages/publisher/ItemPage'
import CompleteOrder from '../pages/CompleteOrder'
import ConsumerLogin from '../pages/ConsumerLogin'
import OrderConfirmation from '../pages/OrderConfirmation'
import Register from '../pages/Register'
import OrderDetail from '../pages/publisher/OrderDetail.vue'
import IlProgetto from '../pages/IlProgetto'
import PerChiCompra from '../pages/PerChiCompra'
import PerChiVende from '../pages/PerChiVende'
import Condizioni from '../pages/Condizioni'
import Privacy from '../pages/Privacy'
import Cookie from '../pages/Cookie'
import User from '../pages/user/User'
import UserOrders from '../pages/user/UserOrders'
import UserAddresses from '../pages/user/UserAddresses'
import OrderDetails from '../pages/user/OrderDetails'
import Payments from '../pages/publisher/Payments'
import TestPayment from '../pages/TestPayment.vue'
import PaymentSuccess from '../pages/PaymentSuccess.vue'
import PaymentCanceled from '../pages/PaymentCanceled.vue'
import Categories from '../pages/publisher/Categories.vue'
import ChangeUserPassword from '../pages/user/ChangeUserPassword.vue'
import RegistrationWizard from '../pages/publisher/RegistrationWizard.vue'
import Sharing from '../pages/publisher/Sharing.vue'
import NotFoundError from '../pages/NotFoundError.vue'
import Subscription from '../pages/publisher/Subscription.vue'

import VersioneAvanzata from '../pages/VersioneAvanzata'

import SubscriptionTest from '../pages/SubscriptionTest.vue'
import GenericError from '../pages/GenericError.vue'
import GenericSuccess from '../pages/GenericSuccess.vue'
import SubscriptionSuccessful from '../pages/SubscriptionSuccessful.vue'


const routes = [{
        path: '/',
        name: 'Home',
        meta: {layout: 'home'},
        component: Homepage,
    },
    // {
    //     path: '/',
    //     name: 'Home',
    //     meta: { layout: 'custom' },
    //     component: Home,
    // },
    // {
    //     path: '/home', // da rimuovere
    //     name: 'Home_old',
    //     meta: { layout: 'custom' },
    //     component: Home_old,
    // },
    {
        path: '/ilprogetto',
        name: 'IlProgetto',
        meta: { layout: 'custom' },
        component: IlProgetto
    },
    {
        path: '/perchivende',
        name: 'PerChiVende',
        meta: { layout: 'custom' },
        component: PerChiVende,
        props: true
    },
    {
        path: '/perchicompra',
        name: 'PerChiCompra',
        meta: { layout: 'custom' },
        component: PerChiCompra
    },
    {
        path: '/condizioni',
        name: 'Condizioni',
        meta: { layout: 'shop' },
        component: Condizioni
    },
    {
        path: '/privacy',
        name: 'privacy',
        meta: { layout: 'custom' },
        component: Privacy
    },
    {
        path: '/cookie',
        name: 'cookie',
        meta: { layout: 'custom' },
        component: Cookie
    },
    {
        path: '/login',
        meta: { layout: 'custom' },
        name: 'Login',
        component: Login
    },
    {
        path: '/:slug/login',
        meta: { layout: 'custom', hideLogo: true },
        name: 'LoginCustomer',
        component: LoginCustomer,
        props: true,
    },
    {
        path: '/user/registrati',
        name: 'Registrati',
        meta: { layout: 'custom' },
        component: Register
    },
    {
        path: '/azienda/registra',
        name: 'RegistraAzienda',
        meta: { layout: 'custom' },
        component: RegistraAzienda
    },
    /* {
        path: '/azienda/shop/',
        name: 'Shop',
        component: Shop
    }, */
    {
        path: '/azienda/:slug/:vat',
        name: 'Retailer',
        meta: { layout: 'shop' },
        component: Shop,
        props: true
    },
    {
        path: '/retailer/:retailer_id/product/:product_id',
        name: 'Product',
        component: ProductPage,
        meta: { layout: 'shop' },
        props: true
    },
    {
        path: '/publisher/:publisher_id/retailer/:retailer_id',
        name: 'Publisher',
        component: Publisher,
        meta: { layout: 'backend' },
        props: true,
        children: [{
                path: 'info',
                component: InfoPublisher,
                meta: { layout: 'custom' },
                props: true,
            },
            {
                path: 'orders',
                component: OrdersPublisher,
                meta: { layout: 'custom' },
                props: true,
            },
            {
                path: 'items',
                name: 'ItemPublisher',
                component: ItemsPublisher,
                meta: { layout: 'custom' },
                props: true,
            },
            {
                path: 'payments',
                name: 'Payments',
                component: Payments,
                meta: { layout: 'custom' },
                props: true,
            },
            {
                path: 'categories',
                name: 'Categories',
                component: Categories,
                meta: { layout: 'custom' },
                props: true
            },
            {
                path: 'sharing',
                name: 'Sharing',
                component: Sharing,
                meta: { layout: 'custom' },
                props: true
            },
            {
                path: 'subscription',
                name: 'Subscription',
                component: Subscription,
                meta: { layout: 'custom' },
                props: true
            }
        ]
    },
    {
        path: '/publisher/:publisher_id/retailer/:retailer_id/wizard',
        name: 'wizard',
        meta: { layout: 'custom' },
        component: RegistrationWizard,
        props: true
    },
    {
        path: '/publisher/:publisher_id/retailer/:retailer_id/items/:item_id',
        name: 'item',
        meta: { layout: 'custom' },
        component: ItemPage,
        props: true
    },
    {
        path: '/publisher/:publisher_id/retailer/:retailer_id/orders/:order_id',
        name: 'OrderDetail',
        meta: { layout: 'custom' },
        component: OrderDetail,
        props: true
    },
    {
        path: '/orders/complete',
        name: 'Order',
        meta: {
            layout: 'shop'
        },
        component: CompleteOrder,
        props: true,
    },
    {
        path: '/user/login',
        name: 'ConsumerLogin',
        component: ConsumerLogin,
        props: true,
    },
    {
        path: '/orders/:order_id/payment_success',
        name: 'PaymentSuccess',
        component: PaymentSuccess,
        meta: {
            layout: 'backend'
        },
        props: true,
    },
    {
        path: '/orders/:order_id/payment_canceled',
        name: 'PaymentCanceled',
        component: PaymentCanceled,
        meta: {
            layout: 'backend'
        },
        props: true,
    },
    {
        path: '/order-submitted',
        name: 'Order-submitted',
        component: OrderConfirmation,
        meta: {
            layout: 'shop'
        },
        props: true
    },
    {
        path: '/user/:user_id',
        name: 'User',
        component: User,
        props: true,
        children: [{
                path: 'orders',
                name: 'UserOrders',
                component: UserOrders,
                meta: { layout: 'shop' },
                props: true,
                // children: [{
                //     path: ':order_id',
                //     name: 'OrderDetails',
                //     component: OrderDetails,
                //     props: true
                // }]
            },
            {
                path: 'addresses',
                name: 'UserAddresses',
                component: UserAddresses,
                meta: { layout: 'shop' },
                props: true,
            },
            {
                path: 'password',
                name: 'ChangeUserPassword',
                component: ChangeUserPassword,
                meta: { layout: 'shop' },
                props: true,
            },
        ]
    },
    {
        path: '/user/:user_id/orders/:order_id',
        name: 'OrderDetails',
        component: OrderDetails,
        meta: { layout: 'shop' },
        props: true
    },
    {
        path: '/stripe',
        name: 'Stripe',
        component: TestPayment,
        meta: { layout: 'backend' },
        props: true
    },
    {
        path: '/versione-avanzata',
        name: 'VersioneAvanzata',
        component: VersioneAvanzata,
        meta: { layout: 'backend' },
        props: true
    },
    {
        path: '/subscription',
        name: 'TestSubscription',
        component: SubscriptionTest,
        meta: {
            layout: 'custom'
        },
        props: true,
    },
    {
        path: '/error',
        name: 'GenericError',
        component: GenericError,
        meta: {
            layout: 'basic'
        },
        props: true
    },
    {
        path: '/success',
        name: 'GenericSuccess',
        component: GenericSuccess,
        meta: {
            layout: 'basic'
        },
        props: true
    },
    {
        path: '/subscription-success',
        name: 'SubscriptionSuccessful',
        component: SubscriptionSuccessful,
        meta: {
            layout: 'basic'
        }
    },
    {
        path: '/:catchAll(.*)',
        name: 'NotFoundError',
        component: NotFoundError,
        meta: {
            layout: 'default'
        }
    }
]

export default routes;
