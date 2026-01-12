export const formatDate = (value?: string): string =>
    value ? value.replace('T', ' ').slice(0, 16) : '-'