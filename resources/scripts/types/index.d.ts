

// @ts-ignore
declare module 'ziggy-js';
declare module 'autosize';
declare module 'bootstrap';
// @ts-ignore
import Router from 'ziggy-js/src/js/Router.js'
export {};

declare global {
    interface Window {
        flasher: any; // 👈️ turn off type checking
    }
    function route(): Router;
    function route(route:string): string;
    function route(route:string,params:null): string;
}
