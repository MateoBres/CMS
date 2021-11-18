import axios from 'axios'
//import store from '../store'


export default () => {
  return axios.create({
    baseURL: `http://127.0.0.1:8000/api`,
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'multipart/form-data'
      //Authorization: `${localStorage.getItem("token")}`
      //Authorization: `Bearer ${localStorage.getItem("token")}`
    }
  })
}
