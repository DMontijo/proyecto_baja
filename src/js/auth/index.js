import 'core-js/stable'
import Vue from 'vue'
import '@coreui/coreui'

// Styles for Auth views
import '../../scss/auth'
// Login
Vue.component(
    'ci-login',
    require('../components/LoginComponent').default
)
// Forget
Vue.component(
    'ci-forget',
    require('../components/ForgetComponent').default
)
// Register
Vue.component(
    'ci-register',
    require('../components/RegisterComponent').default
)

/**
 * [auth description]: Instanciamos Vue en 'auth'
 * @type {Vue}
 */
new Vue({
    el: '#auth',
    data: {
    	msg: 'Auth - FGEBC'
	}
})
