export const leftMenuItemsMixin = {
    data() {
        return {
            menuList: [
                {
                    label: 'Departments',
                    icon:'sitemap',
                    link:'department.index',
                    linkType:'route',
                    type:'standard',
                    activeKey:['department'],
                },
                {
                    label: 'Staff',
                    icon:'user-cog',
                    linkType:'external',
                    type:'dropdown',
                    activeKey:['staff','job-description'],
                    items: [
                        {
                            label: 'Staff',
                            icon:'user-circle',
                            link:'staff.index',
                            linkType:'route',
                            type:'standard',
                            activeKey:['staff'],

                        },
                        {
                            label: 'Job Description',
                            icon:'dot-circle',
                            link:'job-description.index',
                            linkType:'route',
                            type:'standard',
                            activeKey:['job-description'],
                        }
                    ]
                },
                {
                    label: 'Machine',
                    icon:'cogs',
                    linkType:'external',
                    type:'dropdown',
                    activeKey:['machine','machine-type'],
                    items: [
                        {
                            label: 'Machines',
                            icon:'solar-panel',
                            link:'machine.index',
                            linkType:'route',
                            type:'standard',
                            activeKey:['machine'],
                        },
                        {
                            label: 'Machine Types',
                            icon:'th-list',
                            link:'machine-type.index',
                            linkType:'route',
                            type:'standard',
                            activeKey:['machine-type'],
                        }
                    ]
                },
                {
                    label: 'Maintenance',
                    icon:'solar-panel',
                    linkType:'external',
                    type:'dropdown',
                    activeKey:['maintenance','maintenance-action','maintenance-plan'],
                    items: [
                        {
                            label: 'Maintenance Orders',
                            icon:'random',
                            link:'maintenance.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Maintenance Actions',
                            icon:'clipboard-list',
                            link:'maintenance-action.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Maintenance Plans',
                            icon:'clipboard-check',
                            link:'maintenance-plan.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Maintenance Types',
                            icon:'th-list',
                            link:'maintenance-type.index',
                            linkType:'standard',
                            type:'dropdown',
                        }
                    ]
                },
                {
                    label: 'Product',
                    icon:'box',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Products',
                            icon:'boxes',
                            link:'product.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Products Types',
                            icon:'th-list',
                            link:'product-type.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Products Variations',
                            icon:'tags',
                            link:'product-variation.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Products Quality Plans',
                            icon:'clipboard-check',
                            link:'product-quality-plan.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Recipes',
                            icon:'mortar-pestle',
                            link:'recipe.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Raw Material',
                    icon:'square-full',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Raw Materials',
                            icon:'shapes',
                            link:'raw-material.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'RM Types',
                            icon:'th-list',
                            link:'raw-material-type.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'RM Quality Plans',
                            icon:'clipboard-check',
                            link:'raw-material-quality-plan.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Regulation',
                    icon:'certificate',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Audits',
                            icon:'user-secret',
                            link:'audit.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Audit Calendar',
                            icon:'calendar',
                            link:'audit-plan.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Audit Firms',
                            icon:'landmark',
                            link:'audit-firm.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Audit Types',
                            icon:'th-list',
                            link:'audit-type.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Auditors',
                            icon:'user-shield',
                            link:'auditor.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Standards',
                            icon:'check-square',
                            link:'standard.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Document',
                    icon:'file-alt',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Documents',
                            icon:'folder-open',
                            link:'document.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Document Types',
                            icon:'th-list',
                            link:'document-type.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Measurement Tool',
                    icon:'balance-scale',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Measurement Tools',
                            icon:'balance-scale',
                            link:'measurement-tool.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'MT Actions',
                            icon:'clipboard-list',
                            link:'measurement-tool-action.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'MT Types',
                            icon:'th-list',
                            link:'measurement-tool-type.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'MT Properties',
                            icon:'bezier-curve',
                            link:'measurement-tool-property.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Complaint',
                    icon:'heart-broken',
                    linkType:'external',
                    type:'dropdown',
                    items: [
                        {
                            label: 'Complaints',
                            icon:'heart-broken',
                            link:'complaint.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Complaint Actions',
                            icon:'clipboard-list',
                            link:'complaint-action.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Complaint Decisions',
                            icon:'gavel',
                            link:'complaint-decision.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Complaint Types',
                            icon:'th-list',
                            link:'complaint-type.index',
                            linkType:'route',
                            type:'standard',
                        },
                        {
                            label: 'Complaint Properties',
                            icon:'bezier-curve',
                            link:'complaint-property.index',
                            linkType:'route',
                            type:'standard',
                        },
                    ]
                },
                {
                    label: 'Customers',
                    icon:'hands-helping',
                    link:'customer.index',
                    linkType:'route',
                    type:'standard',
                },
                {
                    label: 'Suppliers',
                    icon:'store',
                    link:'supplier.index',
                    linkType:'route',
                    type:'standard',
                }
            ],
        }
    }
}
