import {HomeIcon, InfoSquareIcon, LogoutIcon, PackagesIcon, PackageIcon, UserIcon} from "vue-tabler-icons";
import {Inertia} from "@inertiajs/inertia";

interface MenuType {
    userMenu : Array<MenuDataType>,
    headerMenu : Array<MenuDataType>
}

interface MenuDataType {
    name: string,
    link?: string,
    route?: string,
    action?: () => void
    icon?: any,
    divider?: boolean
    active?: boolean
    child?: Array<MenuDataType>
}

export const useMenu = () : MenuType => ({
    userMenu : [
        {
            name: "Hesabım",
            route: 'profile',
            icon: UserIcon
        },
        {
            name: "Oturumu Kapat",
            action: () => {
                Inertia.post(route('logout'))
            },
            icon: LogoutIcon,
            divider: true
        },
    ],
    headerMenu: [
        {
            name: "Ana Sayfa",
            route: 'index',
            icon: HomeIcon
        },
        {
            name: "Menu 2",
            active: false,
            icon: PackagesIcon,
            child: [
                {
                    name: 'Menu 2-1',
                    link: '#menu2-1',
                    icon: PackageIcon,
                },
                {
                    name: 'Menu 2-2',
                    action: () =>  {
                        console.log('baba')
                        alert('baba menu 2')
                    },
                    icon: PackageIcon,
                }
            ],
        },
        {
            name: "Hakkında",
            route: 'about',
            icon: InfoSquareIcon
        }
    ]
});

