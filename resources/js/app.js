require("./bootstrap");

import {createApp, h} from "vue";
import {createInertiaApp} from "@inertiajs/inertia-vue3";
import {InertiaProgress} from "@inertiajs/progress";

// Fontawesome

import {library} from "@fortawesome/fontawesome-svg-core";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faCss3, faJs, faVuejs} from "@fortawesome/free-brands-svg-icons";
import {
    faDotCircle, //Iconless Item
    faSitemap, // Departments
    faUserCog, //Staff
    faUserCircle, //Staff List
    faCogs, //Machines
    faSolarPanel, //Machine List
    faThList, //Types
    faTools, //Maintance
    faClipboardList, //Action
    faRandom, //Order
    faClipboardCheck, //Plan
    faBox, //Products
    faBoxes, //Product List
    faTags, //Product Variation
    faMortarPestle, //Product Recipe
    faSquareFull, //Raw Materials
    faShapes, //Raw Materials List
    faCertificate, //Regulations
    faUserSecret, //Audits
    faLandmark, //Audit Firms
    faCalendar, //Audit Calendar
    faUserShield, //Auditors
    faCheckSquare, //Standards
    faFileAlt, //Documents
    faFolderOpen, //Documents List
    faBalanceScale, //Measurement Tools
    faBezierCurve, //Properties
    faHeartBroken, //Customer Complaints
    faGavel, //Customer Complaint Decisions
    faHandsHelping, //Customers
    faStore,  //Manufacturers
    faRocket,
    faWindowRestore,
    faEdit,
    faCalendarAlt,
    faEnvelope,
    faTasks,
    faWindowMaximize,
    faChartBar,
    faChevronDown,
    faCode,
    faAngleDown,
    faAngleUp,
    faLayerGroup,
    faGripHorizontal,
    faAngleLeft,
    faClock,
    faRetweet,
    faTv,
    faPlug,
    faTable,
    faShoppingBag,
    faLiraSign,
    faTrash,
    faPlusCircle,
    faAngleDoubleRight,
    faCheck,
    faMinusCircle,
    faInfo,
    faSave,
    faCog
} from '@fortawesome/free-solid-svg-icons'

library.add(
    faDotCircle,
    faSitemap,
    faUserCog,
    faUserCircle,
    faCogs,
    faSolarPanel,
    faThList,
    faTools,
    faClipboardList,
    faRandom,
    faClipboardCheck,
    faBox,
    faBoxes,
    faTags,
    faMortarPestle,
    faSquareFull,
    faShapes,
    faCertificate,
    faUserSecret,
    faLandmark,
    faCalendar,
    faUserShield,
    faCheckSquare,
    faFileAlt,
    faFolderOpen,
    faBalanceScale,
    faBezierCurve,
    faHeartBroken,
    faGavel,
    faHandsHelping,
    faStore,
    faRocket,
    faDotCircle,
    faWindowRestore,
    faSave,
    faEdit,
    faJs,
    faCss3,
    faInfo,
    faCalendarAlt,
    faVuejs,
    faEnvelope,
    faTasks,
    faWindowMaximize,
    faChartBar,
    faChevronDown,
    faCode,
    faAngleDown,
    faAngleUp,
    faChartBar,
    faLayerGroup,
    faGripHorizontal,
    faAngleLeft,
    faClock,
    faRetweet,
    faTags,
    faTv,
    faPlug,
    faTable,
    faShoppingBag,
    faLiraSign,
    faTrash,
    faPlusCircle,
    faAngleDoubleRight,
    faCheck,
    faMinusCircle,
    faCog
)

//i18n
import {createI18n} from "vue-i18n";
import messages from "@/language";

const i18n = createI18n({
    legacy: false,
    globalInjection: true,
    locale: "en",
    fallbackLocale: "en",
    messages
});


const appName = window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({el, app, props, plugin}) {
        return createApp({
            render: () => h(app, props)
        })
            .use(plugin)
            .use(i18n)
            .component("font-awesome-icon", FontAwesomeIcon)
            .mixin({methods: {route}})
            .mount(el);
    }
});

InertiaProgress.init({color: "#4B5563"});
