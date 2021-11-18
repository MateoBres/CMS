<template>
    <section id="registerSection" class="col-md-8">
        <div class="card shadow text-left">
            <div class="card-header">
                Register
            </div>
            <div class="card-body">
                <div class="card-text">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a
                                class="nav-item nav-link active"
                                id="nav-user-tab"
                                data-toggle="tab"
                                href="#nav-user"
                                role="tab"
                                aria-controls="nav-user"
                                aria-selected="true"
                                >voglio solo ordinare</a
                            >
                            <a
                                class="nav-item nav-link"
                                id="nav-retailer-tab"
                                data-toggle="tab"
                                href="#nav-retailer"
                                role="tab"
                                aria-controls="nav-retailer"
                                aria-selected="false"
                                >voglio ricevere ordini</a
                            >
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div
                            class="tab-pane fade show active"
                            id="nav-user"
                            role="tabpanel"
                            aria-labelledby="nav-retailer-tab"
                        >
                            <registrationForm type="st_user"></registrationForm>
                        </div>
                        <div
                            class="tab-pane fade"
                            id="nav-retailer"
                            role="tabpanel"
                            aria-labelledby="nav-retailer-tab"
                        >
                            <registrationForm
                                type="publisher"
                            ></registrationForm>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import registrationForm from "./FormComponent";
export default {
    components: {
        registrationForm
    }
};
</script>

<style></style>
