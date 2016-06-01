class ProjectItemController {
    constructor(API) {
        'ngInject';

        this.API = API;
    }
}

export const ProjectItemComponent = {
    templateUrl: './views/app/components/project_item/project_item.component.html',
    controller: ProjectItemController,
    controllerAs: 'vm',
    bindings: {}
}


