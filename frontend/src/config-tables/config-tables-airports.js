export default [
    {
        name: 'id',
        required: true,
        label: 'ID',
        align: 'center',
        field: row => row.id,
        // format: val => `${val}`,
        sortable: true
    },
    {
        name: 'name',
        required: true,
        label: 'Nombre',
        align: 'center',
        field: row => row.name,
        // format: val => `${val}`,
        sortable: true
    },
    {
        name: 'code',
        required: true,
        label: 'Código',
        align: 'center',
        field: row => row.code,
        // format: val => `${val}`,
        sortable: true
    },
    {
        name: 'city',
        required: true,
        label: 'Ciudad',
        align: 'center',
        field: row => row.city,
        // format: val => `${val}`,
        sortable: true
    },
    {
        name: 'actions',
        required: true,
        label: '',
        align: 'center',
        field: row => row.city,
        // format: val => `${val}`,
        sortable: true
    }
]