interface IProduct {
  id: number;
  slug: string;
  sku: string;
  name: string;
  description: string;
  thumbnail_url: string;
  brand_id: number;
  brand: {
    id: number;
    name: string;
    slug: string;
    qty_item: string;
  };
  categories: {
    id: number;
    parent_id: number;
    name: string;
    slug: string;
    description: string;
  }[];
  sizes: {
    id: number;
    value: string;
    lowest_price: string;
    variants: {
      id: number;
      sku: string;
      item_id: number;
      size_id: number;
      size: {
        id: number;
        value: string;
      };
      color_id: number;

      color: {
        id: number;
        name: string;
        value: string;
      };
      lowest_price: string;
      latest_sale: null | any;
      status: number;
    }[];
  }[];
  colors: {
    id: number;
    name: string;
    value: string;
    lowest_price: string;
    variants: {
      id: number;
      sku: string;
      item_id: number;
      size_id: number;
      color_id: number;
      lowest_price: string;
      status: number;
    }[];
  }[];

  is_sale: number | null;
  stock_old_price: string;
  stock_lowest_price: string;
  views_count: null | number;
  variants: [
    {
      id: number;
      sku: string;
      item_id: number;
      size_id: number;
      size: {
        id: number;
        value: string;
      };
      color_id: number;
      color: {
        id: number;
        name: string;
        value: string;
      };
      lowest_price: string;
      latest_sale: null | any;
      status: number;
    }
  ];
  media: {
    id: number;
    file_name: string;
    url: string;
    full_url: string;
    path: string;
    order_column: number;
  }[];
  created_at: string;
  updated_at: string;
}

export default IProduct;
