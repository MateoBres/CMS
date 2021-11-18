//import Api from './Api'
import axios from 'axios'

export default {
    login(body) {
        return axios.post('/api/login', body, {
            headers: {
                //'Accept': 'application/json',
                'Content-Type': 'multipart/form-data',
            }
        })
    },

    create(body) {
        return axios.post(`/api/register/user`, body, {
            headers: {
                //'Accept': 'application/json',
                'Content-Type': 'multipart/form-data',
            }
        })
    },
}