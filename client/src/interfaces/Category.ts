interface ICategory {
  id: number;
  parent_id: null;
  name: {
    en: string;
    vn: string;
  };
  slug: string;
  description: string;
  status: boolean;
  children?: ICategory[];
}

export default ICategory;
