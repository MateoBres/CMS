<template>
  <div class="col col-12 bg-secondary py-4 px-4 my-4">
      <div class="row">
          <div class="col col-12">
              <h4>INFO DELIVERY</h4>
          </div>
          <div class="col-12 col-md-3">
              <p>
                <strong>
                Da:    
                </strong> 
                    <br>
                  {{ item.from }}
              </p>
          </div>
          <div class="col-12 col-md-3">
              <p>
                  <strong>
                  A: 
                  </strong>
                  <br>{{ item.to }}
              </p>
          </div>
          <div class="col-12 col-md-3">
              <p>
                  <strong>
                    Data: 
                  </strong>
                  <br>{{ item.date }}
              </p>
          </div>
          <div class="col-12 col-md-3">
              <p>
                  <strong>
                    Corriere: 
                  </strong>
                  <br>{{ item.owner.firstName }} {{ item.owner.lastName}}
              </p>
          </div>
          <div class="col col-12 flex gap-4">
              <button class="btn btn-success">CONFERMA</button>
              <button class="btn btn-danger">ANNULLA</button>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    props: ['item']
}
</script>

<style scoped>
    p {color: #ffffff;}
    h4 {color: #ffffff;}
</style>