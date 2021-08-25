export const StaffConsts = {
    data(){
        return{
            status : [
                {id: 1, name: 'Active', color: 'solid-green'},
                {id: 2, name: 'Left', color: 'solid-yellow'},
                {id: 3, name: 'Fired', color: 'solid-red'},
                {id: 4, name: 'Retired', color: 'solid-blue'}
            ],
            bloodGroup : [
                {id: 1, name: '0-'},
                {id: 2, name: '0+'},
                {id: 3, name: 'A-'},
                {id: 4, name: 'A+'},
                {id: 5, name: 'B-'},
                {id: 6, name: 'B+'},
                {id: 7, name: 'AB-'},
                {id: 8, name: 'AB+'},
            ],
            collarType: [
                {id: 1, name: 'White Collar', icon: 'TWhiteCollarIcon', style: 'text-gray-500'},
                {id: 2, name: 'Blue Collar', icon: 'TBlueCollarIcon', style: 'text-blue-500'}
            ]
        }
    }
}