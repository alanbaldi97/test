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
        name: 'description',
        required: true,
        label: 'Observación',
        align: 'center',
        field: row => row.description,
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