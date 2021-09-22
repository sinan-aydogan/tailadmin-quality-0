export const AuditFirmConsts = {
    data(){
        return{
            status : [
                {id: 1, name: 'Active', color: 'solid-green'},
                {id: 2, name: 'Passive', color: 'solid-yellow'},
                {id: 3, name: 'Blocked for Enter', color: 'solid-red'}
            ],
            type : [
                {id: 1, name: 'Product Certification'},
                {id: 2, name: 'System Certification'},
                {id: 3, name: 'Government Agency'},
                {id: 4, name: 'Customer Auditor Agency'},
                {id: 5, name: 'Other'},
            ],
        }
    }
}
