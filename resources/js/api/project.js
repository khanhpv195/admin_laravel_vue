import request from '@/utils/request';

export function fetchList(query) {
    return request({
        url: '/projects',
        method: 'get',
        params: query,
    });
}


