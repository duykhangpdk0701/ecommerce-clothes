interface IOrder {
  id: number;
  order_code: string;
  shipping_name: string;
  shipping_address: string;
  shipping_country_id: null | number;
  shipping_city_id: number;
  shipping_district_id: number;
  shipping_ward_id: number;
  shipping_phone: string;
  payment_method: string;
  payment_code: null;
  total_price: string;
  total_discount: string;
  total_tax: string;
  total_shipping: string;
  total_payment_fee: string;
  total: string;
  order_status_id: 1;
  order_status_value: string;
  number_order_items: string;
  coupon: null;
  order_items: [
    {
      id: number;
      item: {
        id: number;
        slug: string;
        sku: string;
        name: string;
        description: string;
        thumbnail_url: string;
        brand_id: number;
        views_count: null;
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
      };
      variants: {
        id: number;
        sku: string;
        item_id: number;
        size_id: number;
        color_id: number;
        lowest_price: null;
        status: number;
      };
      item_name: string;
      size_id: number;
      size_value: string;
      color_name: string;
      color_value: string;
      price: number;
      order_code: string;
      quantity: number;
      coupon_code: null;
      discount: string;
      order_status_value: string;
      created_at: string;
      updated_at: string;
      uuid: string;
    }
  ];
  created_at: string;
  updated_at: string;
}

export default IOrder;
