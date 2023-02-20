interface ICategory {
  id: number;
  parent_id: null;
  name: {
    en: string;
    vn: string;
  };
  slug: string;
  description: string;
  children?: ICategory[];
}

export interface IAdminCategory extends ICategory {
  status: boolean;
}

export default ICategory;
