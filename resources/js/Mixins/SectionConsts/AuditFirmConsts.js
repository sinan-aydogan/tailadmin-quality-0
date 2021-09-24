export const AuditFirmConsts = {
    data(){
        return{
            status : [
                {id: 1, name: 'Active', color: 'solid-green'},
                {id: 2, name: 'Passive', color: 'solid-yellow'},
                {id: 3, name: 'Blocked for Enter', color: 'solid-red'}
            ],
            firm_type : [
                {id: 1, name: 'Private Auditor Agency'},
                {id: 2, name: 'Government Agency'},
                {id: 3, name: 'Customer Auditor Agency'},
                {id: 4, name: 'Other'},
            ],
        }
    }
}
