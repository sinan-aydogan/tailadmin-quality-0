export const leftMenu = {
    data() {
        return {
            leftMenuLinks: [
                {
                    label: 'Departments',
                    icon: 'sitemap',
                    link: 'department.index',
                    type: 'route'
                },
                {
                    label: 'Staff',
                    icon: 'user-cog',
                    type: 'dropdown',
                    items: [
                        {
                            label: 'Staff',
                            icon: 'user-circle',
                            link: 'staff.index',
                            type: 'route'
                        },
                        {
                            label: 'Job Description',
                            icon: 'dot-circle',
                            link: 'job-description.index',
                            type: 'route'
                        }
                    ]
                },
                {
                    label: 'Machine',
                    icon: 'cogs',
                    type: 'dropdown',
                    items: [
                        {
                            label: 'Machines',
                            icon: 'solar-panel',
                            link: 'machine.index',
                            type: 'route'
                        },
                        {
                            label: 'Machine Types',
                            icon: 'th-list',
                            link: 'machine-type.index',
                            type: 'route'
                        }
                    ]
                },
                {
                    label: 'Maintenance',
                    icon: 'solar-panel',
                    type: 'dropdown',
                    items: [
                        {
                            label: 'Maintenance Orders',
                            icon: 'random',
                            link: 'maintenance.index',
                            type: 'route'
                        },
                        {
                            label: 'Maintenance Actions',
                            icon: 'clipboard-list',
                            link: 'maintenance-action.index',
                            type: 'route'
                        },
                        {
                            label: 'Maintenance Plans',
                            icon: 'clipboard-check',
                            link: 'maintenance-plan.index',
                            type: 'route'

                        },
                        {
                            label: 'Maintenance Types',
                            icon: 'th-list',
                            link: 'maintenance-type.index',
                            type: 'dropdown',
                        }
                    ]
                },
                {
                    label: 'Product',
                    icon: 'box',
                    type: 'dropdown',
                    items: [
                        {
                            label: 'Products',
                            icon: 'boxes',
                            link: 'product.index',
                            type: 'route'
                        },
                        {
                            label: 'Products Types',
                            icon: 'th-list',
                            link: 'product-type.index',
                            type: 'route'
                        },
                        {
                            label: 'Products Quality Plans',
                            icon: 'clipboard-check',
                            link: 'product-quality-plan.index',
                            type: 'route'
                        },
                        {
                            label: 'Recipes',
                            icon: 'mortar-pestle',
                            link: 'recipe.index',
                            type: 'route'
                        },
                    ]
                },
                {
                    label: 'Raw Material',
                    icon: 'square-full',
                    type: 'dropdown',
                    items: [
                        {
                            label: 'Raw Materials',
                            icon: 'shapes',
                            link: 'raw-material.index',
                            type: 'route'
                        },
                        {
                            label: 'RM Types',
                            icon: 'th-list',
                            link: 'raw-material-type.index',
                            type: 'route'
                        },
                        {
                            label: 'RM Quality Plans',
                            icon: 'clipboard-check',
                            link: 'raw-material-quality-plan.index',
                            type: 'route'
                        },
                    ]
                },
                {
                    label: 'Regulation',
                    icon: 'certificate',
                    type: 'dropdown',
                    items: [
                        {
                            label: 'Audits',
                            icon: 'user-secret',
                            link: 'audit.index',
                            type: 'route'
                        },
                        {
                            label: 'Audit Calendar',
                            icon: 'calendar',
                            link: 'audit-plan.index',
                            type: 'route'
                        },
                        {
                            label: 'Audit Firms',
                            icon: 'landmark',
                            link: 'audit-firm.index',
                            type: 'route'
                        },
                        {
                            label: 'Audit Types',
                            icon: 'th-list',
                            link: 'audit-type.index',
                            type: 'route'
                        },
                        {
                            label: 'Auditors',
                            icon: 'user-shield',
                            link: 'auditor.index',
                            type: 'route'
                        },
                        {
                            label: 'Standards',
                            icon: 'check-square',
                            link: 'standard.index',
                            type: 'route'
                        },
                    ]
                },
                {
                    label: 'Document',
                    icon: 'file-alt',
                    type: 'dropdown',
                    items: [
                        {
                            label: 'Documents',
                            icon: 'folder-open',
                            link: 'document.index',
                            type: 'route'
                        },
                        {
                            label: 'Document Types',
                            icon: 'th-list',
                            link: 'document-type.index',
                            type: 'route'
                        },
                    ]
                },
                {
                    label: 'Measurement Tool',
                    icon: 'balance-scale',
                    type: 'dropdown',
                    items: [
                        {
                            label: 'Measurement Tools',
                            icon: 'balance-scale',
                            link: 'measurement-tool.index',
                            type: 'route'
                        },
                        {
                            label: 'MT Actions',
                            icon: 'clipboard-list',
                            link: 'measurement-tool-action.index',
                            type: 'route'
                        },
                        {
                            label: 'MT Types',
                            icon: 'th-list',
                            link: 'measurement-tool-type.index',
                            type: 'route'
                        },
                        {
                            label: 'MT Properties',
                            icon: 'bezier-curve',
                            link: 'measurement-tool-property.index',
                            type: 'route'
                        },
                    ]
                },
                {
                    label: 'Complaint',
                    icon: 'heart-broken',
                    type: 'dropdown',
                    items: [
                        {
                            label: 'Complaints',
                            icon: 'heart-broken',
                            link: 'complaint.index',
                            type: 'route'
                        },
                        {
                            label: 'Complaint Actions',
                            icon: 'clipboard-list',
                            link: 'complaint-action.index',
                            type: 'route'
                        },
                        {
                            label: 'Complaint Decisions',
                            icon: 'gavel',
                            link: 'complaint-decision.index',
                            type: 'route'
                        },
                        {
                            label: 'Complaint Types',
                            icon: 'th-list',
                            link: 'complaint-type.index',
                            type: 'route'
                        },
                        {
                            label: 'Complaint Properties',
                            icon: 'bezier-curve',
                            link: 'complaint-property.index',
                            type: 'route'
                        },
                    ]
                },
                {
                    label: 'Customers',
                    icon: 'hands-helping',
                    link: 'customer.index',
                    type: 'route'
                },
                {
                    label: 'Suppliers',
                    icon: 'store',
                    link: 'supplier.index',
                    type: 'route'
                }
            ]
        }
    }
};
