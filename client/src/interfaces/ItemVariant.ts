import IColor from "./Color";
import IProduct from "./Product";
import ISize from "./Size";

interface IItemVariant {
  id: number;
  sku: string;
  item_id: number;
  item: IProduct;
  size_id: number;
  size: ISize;
  color_id: number;
  color: IColor;
  lowest_price: number | null;
  lowest_in_stock_item_stock: {
    id: number;
    price_in: string;
    price_out: string;
    price: string;
    is_sale: null;
    old_price: string;
    stock_status: number;
  };
  status: number;
}

export default IItemVariant;
