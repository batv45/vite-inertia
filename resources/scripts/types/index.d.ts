// @ts-ignore
declare module 'autosize';
declare module 'bootstrap';

export {};

declare global {
    interface Window {
        flasher: any; // 👈️ turn off type checking
    }
    function route(route:string): string;
    function route(route:string,params:null): string;
}
