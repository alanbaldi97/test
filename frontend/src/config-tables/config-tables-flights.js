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
        name: 'code',
        required: true,
        label: 'Código',
        align: 'center',
        field: row => row.code,
        // format: val => `${val}`,
        sortable: true
    },
    {
        name: 'type',
        required: true,
        label: 'Ciudad',
        align: 'center',
        field: row => row.type,
        // format: val => `${val}`,
        sortable: true
    },
    {
        name: 'departure',
        required: true,
        label: 'Sálida',
        align: 'center',
        field: row => row.departure.name,
        // format: val => `${val}`,
        sortable: true
    },
    {
        name: 'destination',
        required: true,
        label: 'Destino',
        align: 'center',
        field: row => row.destination.name,
        // format: val => `${val}`,
        sortable: true
    },
    {
        name: 'departure_time',
        required: true,
        label: 'Hora de sálida',
        align: 'center',
        field: row => row.departure_time,
        // format: val => `${val}`,
        sortable: true
    },
    {
        name: 'arrival_time',
        required: true,
        label: 'Hora de llegada',
        align: 'center',
        field: row => row.arrival_time,
        // format: val => `${val}`,
        sortable: true
    },
    {
        name: 'airline',
        required: true,
        label: 'Aerolinea',
        align: 'center',
        field: row => row.airline.name,
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