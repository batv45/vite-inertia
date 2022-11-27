import {App, AppConfig, onMounted} from 'vue'
import autosize from "autosize";
// import * as Tooltip from 'bootstrap/js/dist/tooltip';
import {Tooltip} from 'bootstrap';
import {Inertia} from "@inertiajs/inertia";
import notyf from "@flasher/flasher-notyf"
import {usePage} from "@inertiajs/inertia-vue3";
import flasher, {FlasherResponse} from "@flasher/flasher";

export default {
    install: (app: App, options: AppConfig) => {

        Inertia.on('error', (errors) => {
            notyf.error('Bir hata oluştu!')
        })
        Inertia.on('finish', () => {
            if( !document.getElementsByClassName('modal show').length ){
                document.getElementsByClassName('modal-backdrop')[0]?.remove()
            }
        })


        app.directive('autosize', (el, binding) => {
            autosize(el)
        })
        app.directive('tooltip', (el:Element, binding) => {
            document.getElementsByClassName('tooltip')
            console.log(document.getElementsByClassName('tooltip'))
            let options = {
                delay: {
                    show: 50,
                    hide: 50
                },
                container:'.page',
                html: binding.arg === 'html',
                placement: binding.value ? binding.value : 'auto'
            };
            return new Tooltip(el, options)
        })

    }
}

