
import Api from './Api'

export default {

    all (id) {
      return Api().get('api/retails/' + id + 'items')
    },

    detail (id, itemsID) {
      return Api().get('/api/retails/' + id + '/items' + itemsID)
    },

    create (id, data) {
      return Api().post('/retails/' + id + '/items/create', data)
    },

    update (id, data) {
      return Api().put('/api/retails/' + id + '/', data)
    },

    delete (id, itemsID) {
      return Api().delete('/api/retails/' + id + '/items/' + itemsID)
    } 

}