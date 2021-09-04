export const QualitySpectConsts = {
    data(){
        return{
            spect_type: [
                {id:1, name: 'Product Spect'},
                {id:2, name: 'Raw Material Spect'}
            ],
            limit_type: [
                {id:1, name: 'Min <'},
                {id:2, name: 'Min&Equal =<'},
                {id:3, name: '< Max'},
                {id:4, name: '<= Max&Equal'},
                {id:5, name: 'Equal ='},
                {id:6, name: 'Not Equal !='},
                {id:7, name: 'To Be'},
                {id:8, name: 'Not to Be'},
                {id:9, name: '<Between<'},
                {id:10, name: '<=Between=<'},
            ],
            rule: [
                {id:1, name: 'Required'},
                {id:2, name: 'Recommended'},
                {id:3, name: 'Follow Up'},
                {id:4, name: 'Pilot'},
                {id:5, name: 'Other'}
            ]
        }
    }
}