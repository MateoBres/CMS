
//import Api from './Api'
import axios from 'axios'
import store from '../store'

export default {
    all (body) {
        return axios.get('http://127.0.0.1:8000/api/retails', 
        {
          headers: {
                          //'Accept': 'application/json',
                          'Content-Type': 'multipart/form-data',
                  }
        })
    },

    create (body) {
        return axios.post('http://127.0.0.1:8000/api/retails/create', body, {
            headers: {
                //'Accept': 'application/json',
                //'Content-Type': 'application/json',
                'Content-Type': 'multipart/form-data',
                //'Authorization': `Bearer ${localStorage.getItem("token")}`,
                'Authorization': `Bearer ${store.state.token}`,
            } 
        })
    }
}