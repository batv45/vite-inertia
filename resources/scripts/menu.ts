import {HomeIcon, InfoSquareIcon, LogoutIcon, TablerIconComponent, UserIcon} from "vue-tabler-icons";
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
    icon?: TablerIconComponent|null,
    divider?: boolean
}

export const useMenu = (route: any) : MenuType => ({
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
            name: "Hakkında",
            route: 'about',
            icon: InfoSquareIcon
        }
    ]
});

