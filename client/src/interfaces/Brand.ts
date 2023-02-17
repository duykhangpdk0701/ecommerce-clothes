interface IBrand {
  id: number;
  name: string;
  slug: string;
}

export interface IAdminBrand extends IBrand {
  order: number;
  status: boolean;
}

export default IBrand;
