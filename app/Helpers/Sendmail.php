<?php
class Sendmail {
    
    public function templateOrder($arrParam, $templateMail) {
        $product = '<table style="width:90%" align="center">
                     <tbody>
                        <tr>
                           <th>Hình ảnh</th>
                           <th>Tên sản phẩm</th>
                           <th>Số lượng</th>
                           <th>Giá</th>
                        </tr>';
        if (count($arrParam['item']) > 0) {
            $total = 0;
            foreach ($arrParam['item'] as $v) {
                $item = DB::table('products')->select('title','thumbnail')->where('id',$v['product_id'])->first();
                $item = (array)$item;
                $picture = APPLICATION_URL_ORDER.$item['thumbnail'];
                
                $amountTmp = $v['price'] * $v['sl'];
                $total += $amountTmp;
                $amountFormat = $amountTmp > 0 ? number_format($amountTmp, 0, ',', '.') . ' VNĐ' : 'Liên hệ';
                $product .= '
                    <tr>
                        <td>
                           <p><img src="' . $picture . '" class="CToWUd" style="width:100px"/></p>
                        </td>
                        <td>
                            <div style="margin-left:10px;">
                                <div style="font-weight: bold;">' . $item['title']. '</div>';
                $product .= '</div>
                        </td>
                        <td align="center">' . $v['sl'] . '</td>
                        <td>' . $amountFormat . '</td>
                    </tr>';
            }
        }
        $product .= '<tr>
                           <td colspan="4">
                              <hr/>
                           </td>
                        </tr>
                     </tbody>
                  </table>';
        $totalFormat = $total > 0 ? number_format($total, 0, ',', '.') . ' VNĐ' : 'Liên hệ';
        
        $created = date_format(date_create($arrParam['created_at']), "d/m/Y H:i:s");

        $subject = str_replace(
            array('{id_order}', '{name_email}'),
            array($arrParam['id_order'], $arrParam['name_email']),
            $templateMail['name']
        );
        $body = str_replace(
            array(
                '{product}', '{email}','{fullname}', '{phone}', '{address}',                
                '{id_order}', '{created}','{total}', '{content}'
            ), 
            array(
                $product, $arrParam['email'],$arrParam['name'], $arrParam['phone'], $arrParam['address'],
                $arrParam['id_order'], $created, $totalFormat, $arrParam['content']
            ),
            $templateMail['content']
        );
        
        $rerult = array('subject' => $subject, 'body' => $body);
        return $rerult;
    }

    public function sendEmail($arrParam, $template, $mail_to = array(), $attach_file = array()) {
        require_once 'SMTPMail/PHPMailer.php';

        $config = DB::table('settings')->select('*')->first();
        $config = (array)$config;
        
        
        $flag = false;
        if (is_int($template) > 0) {
            $template_mail = DB::table('mailtemplate')->select('*')->where('type',$template)->first();
            $template_mail = (array)$template_mail;           
            if (count($template_mail) > 0) {
                $flag = true;
                $send_to = array('send_to_user'=>$template_mail['send_to_user'],'send_to_admin'=>$template_mail['send_to_admin']);
                switch ($template) {
                    case '1':
                        $arrParam['name_email'] = $config['name_email'];
                        $result = $this->templateOrder($arrParam, $template_mail);
                        break;
                }
            }
        } else {
            return 'Template phải là số dương.';
        }
        if($flag){
            try {
                $mail = new \PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPDebug = false;
                $mail->SMTPAuth = true;
                if ($config['port'] == 465) {
                    $mail->SMTPSecure = "ssl";
                }
                if ($config['port'] == 587) {
                    $mail->SMTPSecure = "tls";
                }
                $mail->Host = $config['hostmail'];
                $mail->Port = $config['port'];
                $mail->Username = $config['username'];
                $mail->Password = $config['password'];
                $mail->SetFrom($config['email'], $config['name_email']);
                if ($send_to['send_to_user'] == 1) {
                    $mail->AddAddress($mail_to['email'], $mail_to['name']);
                }
                if ($send_to['send_to_admin'] == 1) {
                    $mail->AddAddress($config['email'], $config['name_email']);
                }
                if (count($attach_file) > 0) {
                    $mail->addAttachment($attach_file['tmp_path'], $attach_file['file_name']);
                }
                $mail->CharSet = "utf-8";
                $mail->Subject = $result['subject'];
                $mail->Body = $result['body'];
                $mail->IsHTML(true);
                return $mail->Send();
            } catch (Exception $e) {}
        }
    }
}
